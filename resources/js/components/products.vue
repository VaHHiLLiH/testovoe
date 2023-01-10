<template>
    <div class="sort">
        <img v-bind:class="{active: priceSort}" @click="sortForPrice" title="Сортировать товары по цене" src="../../../public/image/price.png">
        <img v-bind:class="{active: discountSort}" @click="sortForDiscount" title="Сортировать товары по скидке" src="../../../public/image/discount.png">
    </div>
    <div class="products">
        <div class="product" v-for="product in mainProducts">
            <a v-bind:href="'http://finaltest/product/' + product.slug">
                <img v-bind:src="product.image" v-bind:alt="product.name">
                <h4>{{ product.name }}</h4>
            </a>
            <span class="manufacturer">{{ product.brand }}</span>

            <div class="price">
                <span class="oldPrice" v-if="product.price != product.old_price && product.old_price != null">{{ product.old_price }} руб.</span><br/>
                <span v-if="product.discount_value" class="discount">-{{ product.discount_value }}%</span>
                <span v-bind:class="{ newPrice: product.old_price != null }">{{ product.price }} руб.</span>
            </div>
            <div class="description">
                <p>{{ product.description }}</p>
            </div>
        </div>
    </div>
    <div class="nav-bar">
        <span v-if="currentList > 1" @click="getPrev" class="prev">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-bar-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M12.5 15a.5.5 0 0 1-.5-.5v-13a.5.5 0 0 1 1 0v13a.5.5 0 0 1-.5.5zM10 8a.5.5 0 0 1-.5.5H3.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L3.707 7.5H9.5a.5.5 0 0 1 .5.5z"/>
            </svg>
        </span>
        <span class="actual-list">{{ currentList }}</span>
        <span v-if="currentList < maxList" @click="getNext" class="next">
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
            mainProducts: null,
            maxList: null,
            priceSort: false,
            discountSort: false,
            sortable: null,
        }
    },
    mounted() {
        this.getProducts();
        this.getMaxList();
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
        sortForPrice() {
            this.discountSort = false;
            if (this.priceSort) {
                this.priceSort = false;
                this.sortable = null;
            } else {
                this.priceSort = true;
                this.sortable = 'price';
            }
            this.getPieceProducts();
        },
        sortForDiscount() {
            this.priceSort = false;
            if (this.discountSort) {
                this.discountSort = false;
                this.sortable = null;
            } else {
                this.discountSort = true;
                this.sortable = 'discount';
            }
            this.getPieceProducts();
        },
        getProducts() {
            this.mainProducts = this.products;
        },
        getMaxList() {
            axios
                .post('/api/getMaxList', {
                    category_id: this.category.id,
                })
                .then(response => {this.maxList = response.data});
        },
        getNext() {
            this.currentList++;
            this.getPieceProducts();
        },
        getPrev() {
            this.currentList--;
            this.getPieceProducts();
        },
        getPieceProducts() {
          axios
              .post('/api/takeProducts', {
                  category_id: this.category.id,
                  from: this.currentList,
                  sortable: this.sortable,
              })
              .then(response => {this.mainProducts = response.data});
        }
    }

}
</script>
