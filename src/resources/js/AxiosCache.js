let calcHash = function(s) {
    for(var i = 0, h = 0xdeadbeef; i < s.length; i++)
        h = Math.imul(h ^ s.charCodeAt(i), 2654435761)
    return (h ^ h >>> 16) >>> 0
}

let cache = new Map()
let buffer = new Map()

window.axios.get = (url, config) => {
    let hash = calcHash(url + JSON.stringify(config))

    if (cache.has(hash)) {
        return new Promise((resolve, reject) => {
            resolve(cache.get(hash))
        })
    }

    if (buffer.has(hash)) {
        return buffer.get(hash)
    }

    buffer.set(
        hash,
        window.axios.request(Object.assign(config || {}, {
            method: 'GET',
            url: url
        }))
    )

    buffer.get(hash).then(response => {
        cache.set(hash, response)
        buffer.delete(hash)

        setTimeout(() => {
            cache.delete(hash)
        }, 5000)
    })

    return buffer.get(hash)
}