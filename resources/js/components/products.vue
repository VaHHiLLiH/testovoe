<template>
    <div class="products">
        <div class="product" v-for="product in products">
            <a v-bind:href="'product/' + product.slug">
                <img v-bind:src="product.image" v-bind:alt="product.name">
                <h4>{{ product.name }}</h4>
            </a>
            <span class="manufacturer">{{ product.brand }}</span>

            <div class="price">
                <span class="oldPrice">{{ product.price }} руб.</span><br/>
                <span v-if="product.discount" class="discount">-{{ product.discount }}%</span>
                <span class="newPrice">{{ product.discount_price }} руб.</span>
            </div>
            <div class="description">
                <p>{{ product.description }}</p>
            </div>
        </div>
    </div>
    <div class="nav-bar">
        <span @click="getPrevProducts" class="prev">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5zM10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5z"/>
            </svg>
        </span>
        <span @click="getNextProducts" class="next">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M6 8a.5.5 0 0 0 .5.5h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L12.293 7.5H6.5A.5.5 0 0 0 6 8zm-2.5 7a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5z"/>
            </svg>
        </span>
    </div>
</template>
<script>
export default {
    data () {
        return {
            currentList: 1,
        }
    },
    mounted() {
        /*this.getCount();
        this.firstPage();*/
    },
    props: {
        products: {
            type: Object,
            require: true,
        },
        category: {
            type: Object,
            require: true,
        },
    },
    methods: {
        getNextProducts() {
            axios
                .post('/api/getProducts/', {
                    category_id: this.category.id,
                    from: this.currentList+1,
                })
                .then(response => {this.products = response.data});
        },
        getPrevProducts() {
            axios
                .post('/api/getProducts/', {
                category_id: this.category.id,
                from: this.currentList-1,
            })
                .then(response => {this.products = response.data});
        }
    }

}
</script>
