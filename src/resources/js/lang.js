Vue.prototype.__ = (string, args) => {
    let value = _.get(window.i18n, string.replace('::', '.'))

    _.eachRight(args, (paramVal, paramKey) => {
        value = _.replace(value, `:${paramKey}`, paramVal)
    })

    return value
}
