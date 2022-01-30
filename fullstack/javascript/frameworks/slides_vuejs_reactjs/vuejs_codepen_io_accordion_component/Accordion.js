// noinspection HtmlUnknownAttribute,JSUnresolvedVariable,JSUnresolvedFunction,JSUnusedGlobalSymbols,JSUnusedLocalSymbols

const exampleData1 = [
    {
        id: 1,
        active: true,
        title: "Crushing Spirits",
        details: `
      <p>You can crush me, but you can't crush my spirit! Are you crazy? I can't swallow that. Who's brave enough to fly into something we all keep calling a death sphere? It doesn't look so shiny to me.</p>
      <ul>
        <li>I just want to talk.</li>
        <li>It has nothing to do with mating.</li>
        <li>Fry, that doesn't make sense.</li>
      </ul>
    `
    },
    {
        id: 2,
        active: false,
        title: "Soundtracks",
        details: `
      <p>Ah, the 'Breakfast Club' soundtrack! I can't wait til I'm old enough to feel ways about stuff!</p>
    `
    },
    {
        id: 3,
        active: false,
        title: `The Letter Shaped Like a Man Wearing a Hat`,
        details: `
      <p>And then the battle's not so bad? You'll have all the Slurm you can drink when you're partying with Slurms McKenzie! Say it in Russian!</p>
      <p>Morbo can't understand his teleprompter because he forgot how you say that letter that's shaped like a man wearing a hat.</p>
    `
    }
];
const exampleData2 = [
    {
        id: 1,
        active: false,
        title: "Celebration",
        details: `
      <p>Come on, this is a Bluth family celebration. It's no place for children.</p>
    `
    },
    {
        id: 2,
        active: false,
        title: "Lighter Fluid and Wine",
        details: `
      <p>But where did the lighter fluid come from? Wine only turns to alcohol if you let it sit. But anyhow, can you believe that the only reason the club is going under is because it's in a terrifying neighborhood?</p>
    `
    },
    {
        id: 3,
        active: false,
        title: `What's in Oscar's box?`,
        details: `
      <p>In fact, it was a box of Oscar's legally obtained medical marijuana. Primo bud. Real sticky weed.</p>
      <p>Great, now I'm going to smell to high heaven like a tuna melt!</p>
    `
    }
];

Vue.component("accordion", {
    props: {
        content: {
            type: Array,
            required: true
        },
        multiple: {
            type: Boolean,
            default: false
        }
    },
    data() {
        return {
            groupId: null
        };
    },
    template: `
    <dl class="accordion box" role="presentation">
      <accordion-item
        v-for="item in content"
        :multiple="multiple"
        :item="item"
        :groupId="groupId"
        :key="item.id">
      </accordion-item>
    </dl>
  `,
    mounted() {
        this.groupId = this.$el.id;
    }
});

Vue.component("accordion-item", {
    props: ["item", "multiple", "groupId"],
    template: `
    <div :id="groupId + '-' + item.id" class="accordion-item" :class="{'is-active': item.active}">
      <dt class="accordion-item-title">
        <button @click="toggle" class="accordion-item-trigger">
          <h4 class="accordion-item-title-text">{{item.title}}</h4>
          <span class="accordion-item-trigger-icon"></span>
        </button>
      </dt>
      <transition
        name="accordion-item"
        @enter="startTransition"
        @after-enter="endTransition"
        @before-leave="startTransition"
        @after-leave="endTransition">
        <dd v-if="item.active" class="accordion-item-details">
          <div v-html="item.details" class="accordion-item-details-inner"></div>
        </dd>
      </transition>
    </div>
  `,
    methods: {
        toggle(event) {
            if (this.multiple) this.item.active = !this.item.active;
            else {
                this.$parent.$children.forEach((item, index) => {
                    if (
                        item.$el.id === event.currentTarget.parentElement.parentElement.id
                    )
                        item.item.active = !item.item.active;
                    else item.item.active = false;
                });
            }
        },
        startTransition(el) {
            el.style.height = el.scrollHeight + "px";
        },
        endTransition(el) {
            el.style.height = "";
        }
    }
});

new Vue({
    el: "#app",
    data: {
        example1: exampleData1,
        example2: exampleData2
    }
});
