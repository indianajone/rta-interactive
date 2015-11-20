module.exports = {
    template: require('./modal.template.html'),
    props: {
        show: {
            type: Boolean,
            required: true,
            twoWay: true    
        }
    }
}