<template>
    <div>
        <div class="form-group">
            <router-link to="/" class="btn btn-default">Back</router-link>

        </div>
        <div class="panel panel-default">
            <div class="panel-heading">Создать новую зону</div>
            <div class="panel-body">
                <form v-on:submit="saveForm($event)">
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">ID Зоны</label>
                            <input type="number" v-model="zone.Zone" class="form-control"/>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Название Зоны</label>
                            <input type="text" v-model="zone.Def" class="form-control"/>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <label class="control-label">Номер беглеца</label>
                            <input type="text" v-model="zone.Number" class="form-control"/>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <button class="btn btn-success">Создать</button>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        mounted(){
            let app=this;
            let id  =   app.$route.params.Number;
            app.zoneID=id;
            console.log('Привет');
            axios.get('/api/v1/zones/'+id)
                .then(function (resp) {
                    app.zone=resp.data;

                });

        },
        data: function () {
            return {
                zoneID: null,
                zone: {
                    Zone: 0,
                    Def:'',
                    Number:'',
                }
            }

        },
        methods: {
            saveForm(event) {


                event.preventDefault();

                var app = this;
                var newZone = app.zone;

                axios.patch('/api/v1/zones/'+app.zoneID, newZone)
                    .then(function (resp) {
                     app.$router.replace('/');
                    })
                   .catch(function (resp) {
                     console.log(resp);
                   alert("Не удалось создать компанию");
                 });
            }
        }
    }
</script>