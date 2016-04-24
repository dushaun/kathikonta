Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

Vue.component('tasks', {
    template: '#tasks-template',
    props: ['list'],
    created() {
        this.list = JSON.parse(this.list);
    }
});

new Vue({
    el: 'body',
    data: {
        newTask: {
            name: '',
            user_id: ''
        }
    },
    computed: {
        errors: function() {
            if ( ! this.newTask ) return true;
            return false;
        }
    },
    methods: {
        onSubmitForm: function(e) {
            // prevent the default action
            e.preventDefault();
            // Reset input values
            var task = this.newTask;

            this.newTask = { name: '' };
            // Send POST ajax request
            this.$http.post('create', task)
            $('#myModal').modal( 'hide' );
        }
    }
});

$('#myModal').on('shown.bs.modal', function () {
    $('#myInput').focus()
})