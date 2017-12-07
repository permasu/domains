<template>
    <div class="row">
        <div
                class="input-group"
                v-for="(phone, index) in phones"
            >

            <div class="col-sm-3">
            <div class="input-group">

                <select
                        id="selecttype"
                    name="phone.type"
                    v-model="phone.type"
                    class="form-control">

                    <option value="M">Мобильный</option>
                    <option value="F">Факс</option>
                    <option value="O">Другой</option>

                </select>
            </div>
            </div>

            <div class="col-sm-5">
            <div class="input-group">
                <input
                    type="tel"
                    v-model="phone.number"
                    class="form-control"
                    placeholder="Номер телефона:"
                    id="number">
            </div>
            </div>

            <div class="col-sm-2">
                <div class="input-group">
                <button
                    type="button"
                    class="btn btn-group-lg"
                    @click="addphone">
                    Добавить
                </button>
                </div>
            </div>
            <div class="col-sm-2 ">
                <div class="input-group">
                <button
                        type="button"
                        class="btn btn-group-lg"
                        @click="removephone(index)">
                    Удалить
                </button>
                </div>
            </div>




            </div>

    </div>




</template>
<script>
    export default{
        props: ['phone'],
        data:
        function  (){
            return {
                phones: [{type: '', number: ''}]
            }
        },
        methods:{
        addphone: function (event) {
                event.preventDefault()
                this.phones.push({
                    type: '',
                    number: '',
                });

            this.$nextTick(function () {
                console.log(this.$el.id);
            }.bind(this));
            },
            removephone: function(index){
            this.phones.splice(index,1);
            }
    }

    }
</script>
<style>
    #app {
      line-height: 50px;
        padding: 2 e;
    }
</style>