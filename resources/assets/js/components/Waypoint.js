var Sortable = require('../vendor/Sortable.min.js');

module.exports = {

    template: require('./templates/waypoint.html'),

    props: ['waypoints'],

    data: function () {
        return {
            start: false
        }
    },

    methods: {
        init: function () {
            var self = this;
            Sortable.create(this.$el, {
                draggable: '.waypoint',
                onUpdate: function(e) {
                    self.waypoints.splice(e.newIndex, 0, self.waypoints.splice(e.oldIndex, 1)[0] );
                    self.$dispatch('map.refresh');
                }
            });
        },
        remove: function (waypoint) {
            this.waypoints.$remove(waypoint);
            this.$dispatch('map.refresh');
        }
    },

    watch: {
        waypoints: function () {
            if (!this.start) {
                this.start = true;
                this.init();
            }
        }
    }

}