<template>
    <div>
        <div class="form-group">
            <router-link :to="{name: 'createZone'}" class="btn btn-success">Create new zone</router-link>

        </div>
        <div class="panel panel-default">
            <div class="panel-heading" Список зон></div>
            <div class="panel-body">
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Definition</th>
                        <th>Номер беглеца</th>
                        <th width="100">&nbsp;</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="zone, index in zones">
                        <td>{{zone.Zone }}</td>
                        <td>{{zone.Def}}</td>
                        <td>{{zone.Number}}</td>
                        <td>
                            <router-link to="{name: 'editZone', params:{Number: zone.Number}}"
                                         class="btn btn-xs btn-default">
                                edit
                            </router-link>
                            <a href="#"
                               class="btn btn-xs btn-danger"
                               v-on:click="deleteEntry(zone.Number, index)">
                                Delete
                            </a>
                        </td>
                    </tr>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data: function () {
            return {
                zones: []
            }
        },

        mounted() {
            var app = this;
            axios.get('/api/v1/zones')
                .then(
                    function (resp) {
                        app.zones = resp.data;
                    })
                .catch(function (resp) {
                    console.log(resp);
                    alert('Could not load zones');
                });
        },
        methods: {
            deleteEntry(Number, index) {
                if (confirm("Вы действительно хотите удалить это?")) {
                    var app = this;
                    axios.delete('/api/v1/zones/' + Number)
                        .then(function (resp) {
                            app.zones.splice(index, 1);
                        })
                        .catch(function (resp) {
                            alert('НЕ могу это удалить');
                        });
                }
            }
        }
    }
</script>