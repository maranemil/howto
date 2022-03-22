https://sfc.vuejs.org/ - Vue SFC Playground

<script>
export default {
  data() {
    return {
      text: '123',
      isRed: false,
    }
  },
  methods: {
setRed(){
    if(this.text.length < 5){
        this.isRed = false;
      }
      else{
        this.isRed = true;
      }
}
}
}
</script>

<template>
   <div class="green" :class="{ red: isRed }"> {{ text }} </div>
   <input v-model="text" @input="setRed" />
  <!--
@click="checkInput"
@change="checkInput"
-->
</template>

<style>
.red {
  color: red;
}
</style>

<!--
https://vuejs.org/guide/essentials/forms.html
https://v2.vuejs.org/v2/guide/forms.html
https://vuejs.org/guide/quick-start.html
https://vuejs.org/tutorial/#step-3
https://vuejs.org/examples/#attribute-bindings
https://vuejs.org/examples/#handling-input
https://vuejs.org/guide/quick-start.html
https://vuejs.org/guide/essentials/event-handling.html#method-handlers
https://vuejs.org/style-guide/
https://vuejs.org/guide/introduction.html#what-is-vue
https://thewebdev.info/2020/02/28/add-a-conditional-class-to-a-vue-component/
https://michaelnthiessen.com/conditional-class-binding-vue

https://tailwindcss.com/docs/text-color
https://vuejs.org/tutorial/#step-1
https://vuejs.org/examples/#hello-world
https://vuejs.org/guide/quick-start.html
https://vuejs.org/style-guide/
-->