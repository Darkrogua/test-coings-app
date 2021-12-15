<template>
    <div class="inner-app">
        <add-form
            @update:alert="alert=$event"
            @refresh:form="updateForm()"
        />
        <list-items
            @update:items="updateItems($event)"
            :items="items" :offices="offices"
        />
        <alert :alert="alert" @update:alert="alert=$event" />
    </div>
</template>

<script>
    import axios from "axios";

    import ListItems from "../components/ListExchangeRates";
    import AddForm from "../components/AddExchangeRate";
    import Alert from "../components/Alert";

    export default {
        components: {
            AddForm,
            Alert,
            ListItems
        },
        data: () => ({
            loading: false,
            alert: {
                show: false,
                text: "",
                danger: true
            },
            items: {},
            offices: []
        }),
        mounted() {
            this.loadItems();
            this.loadOffices();
        },
        methods: {
            updateForm() {
                this.loadItems();
                this.loadOffices();
            },
            updateItems(data) {
                if (data.merge) {
                    let items = this.items.data;
                    this.items =  data.records;
                    this.items.data = items.concat(this.items.data);
                } else {
                    this.items =  data.records;
                }
            },
            loadItems() {
                this.loading = true;
                axios.get('api/coings/exchange')
                .then(res => {
                    this.items = res.data.records;
                    this.loading = false;
                })
            },
            loadOffices() {
                this.loading = true;
                axios.get('api/coings/office')
                .then(res => {
                    this.offices = res.data.records;
                    this.loading = false;
                })
            }
        },
    }
</script>

