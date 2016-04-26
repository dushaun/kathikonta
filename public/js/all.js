Vue.http.headers.common['X-CSRF-TOKEN'] = document.querySelector('#token').getAttribute('value');

Vue.component('tasks', {
    template: '#tasks-template',
    props: ['list'],
    created: function() {
        this.fetchTasks();
    },
    methods: {
        fetchTasks: function () {
            this.$http.get('/api/list').then(function(tasks) {
                this.$set('list', tasks.data);
            })
        },
        toggleCompletedFor: function (task) {
            var id = task.id;
            task.done = ! task.done;
            this.$http.patch('/api/check/'+id, task).then(function (task) {
                console.log(task)
                this.fetchTasks()
            })
        },
        onDelete: function (task) {
            var id = task.id;
            this.$http.delete('api/delete/'+id).then(function (id) {
                console.log(id)
                this.fetchTasks()
            }).catch(function (id) {
                console.log(id)
            });
        }
    },
    events: {
        'taskCreated': function () {
            this.fetchTasks();
        }
    }
});

new Vue({
    el: 'body',
    data: {
        tasks: {
            name: '',
            user_id: ''
        }
    },
    computed: {
        errors: function() {
            if ( ! this.tasks.name ) return true;
            return false;
        }
    },
    methods: {
        onSubmitForm: function(e) {
            e.preventDefault();
            var name = this.tasks.name;
            var user_id = this.tasks.user_id;
            var task = { name: name, user_id: user_id }
            this.tasks = { name: '', user_id: user_id };
            this.$http.post('/api/create', task).then(function (task) {
                console.log(task);
                this.$broadcast('taskCreated');
            }).catch(function (task) {
                console.log(task);
            });
            $('#createModal').modal( 'hide' );
        },
        onEditForm: function (e) {
            e.preventDefault()
        }
    }
});

$('#myModal').on('shown.bs.modal', function () {
    $('#myInput').focus()
})
//# sourceMappingURL=all.js.map
