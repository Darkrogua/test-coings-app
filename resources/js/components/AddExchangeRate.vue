<template>
    <section :class="{ loading: this.loading }">
        <h2>Добавить валюту</h2>
        <form class="form-add-coin">
            <div class="form-line-inputs top-line">
                <div class="wrapper-input">
                    <label for="inputCurrency" class="form-label">Валюта</label>
                    <span class="form-input-required">*</span>
                    <input type="text" class="form-input form-control" v-model="currency" placeholder="USD" id="inputCurrency">
                </div>
                <div class="wrapper-input">
                    <label for="inputDate" class="form-label">Дата</label>
                    <span class="form-input-required">*</span>
                    <input type="text" class="form-input form-control" v-model="date" placeholder="01.01.2001" id="inputDate">
                </div>
                <div class="wrapper-input">
                    <label for="inputTime" class="form-label">Время</label>
                    <span class="form-input-required">*</span>
                    <input type="text" class="form-input form-control" v-model="time" placeholder="12:00" id="inputTime">
                </div>
            </div>
            <div class="form-line-inputs bottom-line">
                <div class="wrapper-input">
                    <label for="inputBuy" class="form-label">Покупка</label>
                    <span class="form-input-required">*</span>
                    <input type="text" class="form-input form-control" v-model="buy" placeholder="32.32" id="inputBuy">
                </div>
                <div class="wrapper-input">
                    <label for="inputSell" class="form-label">Продажа</label>
                    <span class="form-input-required">*</span>
                    <input type="text" class="form-input form-control" v-model="sell" placeholder="52.32" id="inputSell">
                </div>
                <div class="wrapper-input">
                    <label for="inputPlace" class="form-label">Офис</label>
                    <input type="text" class="form-input form-control" v-model="office_id" placeholder="Офис 1" id="inputPlace">
                </div>
            </div>

            <div class="">
                <button type="button" @click.prevent="addItem()" class="btn btn-primary btn-default form-btn">Добавить</button>
            </div>

        </form>

    </section>
</template>

<script>
    import axios from "axios";

    export default {
        components: {},
        data: () => ({
            loading: false,
            currency: "",
            buy: "",
            sell: "",
            office_id: null,
            time: "",
            date: "",
            begins_at: "",
            alert: {
                show: false,
                text: "",
                danger: true
            },
        }),
        computed: {
            beginsAt: function () {
                return `${this.date} ${this.time}`;
            }
        },
        methods: {
            addItem() {
                this.loading = true;
                axios.post('api/coings/exchange', {
                    currency: this.currency,
                    buy: this.buy,
                    sell: this.sell,
                    office_id: this.office_id,
                    begins_at: this.beginsAt,
                })
                .then(res => {
                    if (res.data.status) {
                        this.alert.show = true;
                        this.alert.danger = false;
                        this.clearForm();
                        this.alert.text = "Валюта добавлена";
                        this.$emit('update:alert', this.alert);
                        this.$emit('refresh:form');
                    }
                    this.loading = false;
                }).catch(err => {
                    this.alert.show = true;
                    this.alert.text = 'Ошибка при добавлении';
                    this.$emit('update:alert', this.alert);
                    this.loading = false;
                    console.log(err.response.data);
                })
            },
            clearForm() {
                this.currency = "";
                this.buy = "";
                this.sell = "";
                this.office_id = null;
                this.time = "";
                this.date = "";
                this.begins_at = "";
            }
        },
    }
</script>
