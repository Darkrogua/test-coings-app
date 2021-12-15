<template>
    <section :class="{ loading: this.loading }">
        <h2>Курс валют</h2>
        <Dropdown
            v-model="selectedOffice" :options="offices"
            @input="filterOffice($event)" optionLabel="name" placeholder="Все офисы" />
        <div class="wrapper-exchange">
            <template v-if="items.total > 0">
            <div class="list-exchange">
                <div class="list-exchange-title">
                    <div>Валюта</div>
                    <div>Покупка</div>
                    <div>Продажа</div>
                </div>
                <div class="list-exchange-item" v-for="item in items.data">
                    <div>{{ item.code }}</div>
                    <div>{{ item.buy_price }}</div>
                    <div>{{ item.sell_price }}</div>
                </div>
            </div>
            <div class="list-control">
                <div class="list-count">Показано {{items.to }} из {{items.total}}</div>
                <div v-if="showPaginate()">
                    <button
                        type="button"
                        class="btn btn-primary btn-default form-btn"
                        @click="loadMore()"
                    >
                        Загрузить еще
                    </button>
                </div>
            </div>
            </template>
            <template v-else>
                Ничего не найдено!
            </template>
        </div>
    </section>
</template>

<script>
    import Dropdown from 'primevue/dropdown';
    import axios from "axios";

    export default {
        components: { Dropdown },
        props: {
            items: {
                type: Object,
                default: {}
            },
            offices: {
                type: Array,
                default: []
            }
        },
        data() {
            return {
                selectedOffice: null,
                loading: false
            }
        },
        watch: {
            offices: function () {
                this.selectedOffice = 0;
            },
        },
        methods: {
            showPaginate() {
              if (this.items.to < this.items.total) return true;
            },
            loadMore() {
                let officeCode = (this.selectedOffice == 0) ? 0 : this.selectedOffice.name;
                this.getListExchange(`?page=${this.items.current_page+1}&office_id=${officeCode}`, true);
            },
            filterOffice(val) {
                this.getListExchange(`?office_id=${val.name}`);
            },
            getListExchange(url, merge = false) {
                this.loading = true;
                axios.get('api/coings/exchange'+url)
                .then(res => {
                    this.$emit('update:items', {
                        records: res.data.records,
                        merge: merge
                    });
                    this.loading = false;
                })
            }
        }
    }
</script>
