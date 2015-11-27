module.exports = {
    template: require('./modal.template.html'),
    props: {
        open: {
            type: Boolean,
            required: true,
            twoWay: true  
        }
    }
}