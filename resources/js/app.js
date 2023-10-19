import './bootstrap';

import Alpine from 'alpinejs';
import persist from '@alpinejs/persist';
import collapse from '@alpinejs/collapse';
import {post} from "@/http";

Alpine.plugin(collapse);

Alpine.plugin(persist);

window.Alpine = Alpine;




document.addEventListener('alpine:init', () => {
    Alpine.store('header',{
        cartItemObject : Alpine.$persist({}),
        watchingItems: Alpine.$persist([]),
        get watchListItems(){
            return this.watchingItems.length;
        },
        get cartItems(){
            return Object.values(this.cartItemObject).reduce((accum,next) => accum + parseInt(next.quantity),0);
            // let sum = 0;
            // for (let key in this.cartItemObject){
            //     sum += parseInt(this.cartItemObject[key].quantity);
            // }
            // return sum;
        },
    });

    Alpine.data("toast", () => ({
        visible: false,
        delay: 5000,
        percent: 0,
        interval: null,
        timeout: null,
        message: null,
        close() {
            this.visible = false;
            clearInterval(this.interval);
        },

        show(message) {
            this.visible = true;
            this.message = message;

            if (this.interval) {
                clearInterval(this.interval);
                this.interval = null;
            }
            if (this.timeout) {
                clearTimeout(this.timeout);
                this.timeout = null;
            }

            this.timeout = setTimeout(() => {
                this.visible = false;
                this.timeout = null;
            }, this.delay);
            const startDate = Date.now();
            const futureDate = Date.now() + this.delay;
            this.interval = setInterval(() => {
                const date = Date.now();
                this.percent = ((date - startDate) * 100) / (futureDate - startDate);
                if (this.percent >= 100) {
                    clearInterval(this.interval);
                    this.interval = null;
                }
            }, 30);
        },
    }));

    Alpine.data('productItem',(product)  =>({
        id:product.id,
        product,
        addToWatchList() {
            if(this.isInWatchList()){
                this.$store.header.watchingItems.splice(this.$store.header.watchingItems.findIndex((p) => p.id === product.id),1);
                //this.$store.toast.show('The item was removed from watchList');
                this.$dispatch("notify", {
                    message: "The item was removed from watchList",
                });
            }else{
                this.$store.header.watchingItems.push(product);
                this.$dispatch("notify", {
                    message: "The item was added to the watchList",
                });
                //this.$store.toast.show('The item was added to the watchList');
            }
        },
        isInWatchList(){
            return this.$store.header.watchingItems.find((p) => p.id === product.id );
        },
        addToCart(quantity = 1) {
            // this.$store.header.cartItemObject[this.id] = this.$store.header.cartItemObject[this.id] || {...product,quantity:0};
            // this.$store.header.cartItemObject[this.id].quantity = parseInt(this.$store.header.cartItemObject[this.id].quantity) + parseInt(quantity);
            // this.$dispatch("notify", {
            //     message: "The item was added to the cart",
            // });
            // this.$store.toast.show('The item was added to the cart');

            post(this.product.addToCartUrl,{quantity})
                .then(result => {
                    this.$dispatch('cart-change',{count:result.count});
                    this.$dispatch("notify", {
                        message: "The item was added to the cart",
                    });
                }).catch(response => {
                    console.log(response);
            })
        },
        removeItemFromTheCart() {
            // delete this.$store.header.cartItemObject[product.id];
            // this.$dispatch("notify", {
            //     message: "The item was removed from the cart",
            // });
            // this.$store.toast.show('The item was added to the cart');

            post(this.product.removeUrl)
                .then(result => {
                    this.$dispatch("notify", {
                        message: "The item was remove from cart",
                    });
                    this.$dispatch('cart-change',{count:result.count});
                    this.cartItems = this.cartItems.filter(p => p.id !== product.id);
                })
        },
        changeQuantity(){
            post(this.product.updateQuantityUrl, {quantity: product.quantity})
                .then(result => {
                    this.$dispatch('cart-change', {count: result.count})
                    this.$dispatch("notify", {
                        message: "The item quantity was updated",
                    });
                })
                .catch(response => {
                    this.$dispatch('notify', {
                        message: response.message || 'Server Error. Please try again.',
                        type: 'error'
                    })
                })
        },
        removeFromWatchList(){
            this.$store.header.watchingItems.splice(this.$store.header.watchingItems.findIndex((p) => p.id == product.id),1);
        }
    }));

})

Alpine.start();
