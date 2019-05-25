class Lang {
    locale = 'en'
    fallback = 'en'
    source = './i18n'

    setLocale(locale) {
        this.locale = locale
    }

    setFallback(fallback) {
        this.fallback = fallback
    }

    setSource(source) {
        this.source = source
    }

    getSource() {
        return this.source
    }

    get(phrase) {
        let json = require(this.source +'/'+ this.locale +'.json')
        let object = JSON.parse(json)

        return window._.get(object, phrase)
    }
}

window.lang = new Lang()