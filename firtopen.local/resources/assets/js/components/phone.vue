<template>
    <div class="row">

        <div
                class="input-group"
                v-for="(phone, index) in phones"
                :key="index"
        >
            <div class="col-sm-3">
                <div class="input-group">
                    <label>Тип</label>
                    <select name="phone.type" class="form-control" v-model="phone.type">
                        <option value="m">Моб.</option>
                        <option value="w">Раб.</option>
                        <option value="f">Факс</option>
                    </select>
                </div>
            </div>
            <div class="col-sm-5">
                <div class="input-group">
                    <label>Телефон</label>
                    <input
                            type="email"
                            name="phone.number"
                            class="form-control"
                            placeholder="Номер телефона"
                            v-model="phone.number"
                    >
                </div>
            </div>
            <div class="col-sm-2 text-left">
                <button
                        type="button"
                        class="btn btn-light"
                        @click.prevent="removePhone(index)"
                        v-show="quantity > 1"
                >
                    <span aria-hidden="true">&times;</span>
                    Удалить
                </button>
            </div>

            <div class="col-sm-2">
                <button
                        type="button"
                        class="btn btn-secondary"
                        v-on:click="addPhone"
                >
                    Добавить
                </button>
            </div>

        </div>

    </div>

</template>

<script>

    export default {
        props: ['phone'],
        data: function () {
            return {
                phones: [{type: '', number: ''}]
            };
        },
        computed: {
            quantity: function () {
                return this.phones.length;
            },
        },
        methods: {
            removePhone: function (index) {
                this.phone.splice(index, 1);
            },
            addPhone: function (index) {
                event.preventDefault();
                this.phones.push({
                    type: '',
                    number: '',
                });

                this.$nextTick(function () {
                    console.log(this.$el.id);
                }.bind(this));
            }
        },
    };

</script>