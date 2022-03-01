<template>

</template>

<script>
export default {
    data: ()=> 
    { return{ 

       
    }},
    props:['designation','quantity','unitPrice','id'],

    computed:{
        montant(){
            return this.quantity*this.unitPrice +'DZD' ;
        }
    },
    methods:{
        removeItem(){

            this.$emit('remove-item');
        }
    }
}
</script>