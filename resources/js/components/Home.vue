<template>

<div>

<nav class="nav">

<h2>Shop Press</h2>

<div>

<a href="#">Home</a>

<a href="#">Products</a>

<a href="#">
Cart ({{ cart.length }})
</a>

</div>

</nav>


<section class="hero">

<h1>Discover Amazing Products</h1>

<p>Laravel + Vue E-commerce</p>

</section>


<section class="products">

<div
class="card"
v-for="item in products"
:key="item.id"
>

<img
:src="
item.image
?
'/storage/'+item.image
:
'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=800'
"
>

<h3>{{ item.name }}</h3>

<p>Rs {{ item.price }}</p>

<p>{{ item.description }}</p>

<button
@click="addToCart(item)"
>

Add To Cart

</button>

</div>

</section>



<section class="products">

<h2>My Cart</h2>

<button
@click="clearCart"
>

Clear Cart

</button>

<h3>

Total:

Rs

{{
cart.reduce(
(sum,item)=>
sum +
(Number(item.price) * item.qty),
0
)
}}

</h3>


<div
class="card"
v-for="item in cart"
:key="'cart-'+item.id"
>

<h3>{{ item.name }}</h3>

<p>

Qty:
{{ item.qty }}

</p>

<p>

Rs {{ item.price }}

</p>

<button
@click="removeFromCart(item)"
>

Remove

</button>

</div>

</section>

</div>

</template>



<script>

import axios from 'axios'

export default {

data(){

return{

products:[],

cart:
JSON.parse(
localStorage.getItem('cart') || '[]'
)

}

},

mounted(){

axios
.get('/api/products')

.then((res)=>{

this.products =
res.data

})

},

methods:{

addToCart(product){

const existing =

this.cart.find(

item =>
item.id === product.id

)

if(existing){

existing.qty += 1

}

else{

this.cart.push({

...product,

qty:1

})

}

localStorage.setItem(

'cart',

JSON.stringify(
this.cart
)

)

},


removeFromCart(product){

if(product.qty > 1){

product.qty--

}

else{

this.cart =

this.cart.filter(

item=>
item.id!==product.id

)

}

localStorage.setItem(

'cart',

JSON.stringify(
this.cart
)

)

},


clearCart(){

this.cart=[]

localStorage.removeItem(
'cart'
)

}

}

}

</script>