class Wishlist
{
    constructor(products){
        this.products = products;
        this.total = this.products.length;
    }

    static render(){
        if(!localStorage.hasOwnProperty('wishlist')){
            localStorage.setItem('wishlist', JSON.stringify({total: 0, products: []})); 
        }
        
        let list = JSON.parse(localStorage.getItem('wishlist'));
        
        return new this(list.products); 
    }
    
    has(product){
        return this.products.indexOf(parseInt(product)) === -1 ? false : true;
    }
    
    update(){
        this.total = this.products.length;

        localStorage.removeItem('wishlist');
        
        localStorage.setItem('wishlist', JSON.stringify({total: this.total, products: this.products})); 
    }
    
    add(product){
        if(product && !this.has(product)){
            this.products.push(product);
            this.update();
            return true;
        }

        return false;
    }

    remove(product){
        if(this.has(product)){
            this.products.splice(this.products.indexOf(product), 1);
            this.update();
            return true;
        } 

        return false;
    }

    toggle(product){
        if(this.has(parseInt(product))){
            this.remove(parseInt(product))
            return 'delete' 
        } 

        this.add(parseInt(product))
        return 'add'
    }

    list(){
        return this.products;
    }
}

// window.onload = function(){
    window.wishlist = Wishlist.render();
// }