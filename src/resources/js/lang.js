Vue.prototype.get = (string, args) => {
    let value = _.get(window.i18n, string)

    _.eachRight(args, (paramVal, paramKey) => {
        value = _.replace(value, `:${paramKey}`, paramVal)
    })

    return value
}
