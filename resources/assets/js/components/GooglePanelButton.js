module.exports = {
    template: `
        <button class="btn btn-main" @click="toggle">{{ body }}</button>
    `,

    props: ['text'],

    data: function () {
        return {
            show: false
        }
    },

    computed: {
        body: function () {
            let text = JSON.parse(this.text);
            return this.show ? text[1] : text[0];
        }
    },

    methods: {

        toggle: function () {
            let panel = document.getElementById('direction');
            
            if (this.show) {
                panel.style.display = 'none';
            } else {
                panel.style.display = 'block';
            }

            this.show = !this.show;
        }
    }

}

/*
toggleDirection: function () {
            let directionPanel = document.getElementById('direction');

            if(directionPanel.style.display == 'block') {
                this.opened = false;
                directionPanel.style.display = 'none';
            } else {
                this.opened = true;
                directionPanel.style.display = 'block';
            }
            
        }
 */