/*
Slider based on --> http://www.storytrail.co
*/

var app = new Vue({
  el: '#app',
  data: {
    slides: 5,
    active: 1 },

  methods: {
    move(amount) {
      let newActive;
      const newIndex = this.active + amount;
      if (newIndex > this.slides) newActive = 1;
      if (newIndex === 0) newActive = this.slides;
      this.active = newActive || newIndex;
    },
    jump(index) {
      this.active = index;
    },
    addSlide() {
      this.slides = this.slides + 1;
    },
    removeSlide() {
      this.slides = this.slides - 1;
    } } });