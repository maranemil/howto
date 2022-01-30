// noinspection JSUnresolvedVariable,JSUnresolvedFunction

function _defineProperty(obj, key, value) {
    if (key in obj) {
        Object.defineProperty(obj, key, {value: value, enumerable: true, configurable: true, writable: true});
    } else {
        obj[key] = value;
    }
    return obj;
}

const listItems = [
    {title: 'step 1', content: 'Break The UI Into A Component Hierarchy'},
    {title: 'step 2', content: 'Build A Static Version in React'},
    {title: 'step 3', content: 'Identify The Minimal (but complete) Representation Of UI State'},
    {title: 'step 4', content: 'Identify Where Your State Should Live'},
    {title: 'step 5', content: 'Add Inverse Data Flow'}
];


function SlideItem(props) {
    return /*#__PURE__*/ (
        React.createElement("div", {className: "item-slide"}, /*#__PURE__*/
            React.createElement("h1", null, props.title), /*#__PURE__*/
            React.createElement("h2", null, props.content)));


}

const Indicators = props => {
    const listIndicators = listItems.map((item, index) => /*#__PURE__*/
        React.createElement("li", {
                key: index,
                className: props.currentSlide === index ? 'active' : '',
                onClick: () => props.changeSlide(index)
            },
            index + 1));

    return /*#__PURE__*/ (
        React.createElement("ul", {className: "indicators"},
            listIndicators));


};

class Slides extends React.Component {
    constructor(props) {
        super(props);
        _defineProperty(this, "goTo",

            direction => {
                let index = 0;
                switch (direction) {
                    case 'auto':
                        index = this.currentIndex + 1;
                        this.currentIndex = index >= listItems.length ? 0 : index;
                        break;
                    case 'prev':
                        index = this.currentIndex - 1;
                        this.currentIndex = index < 0 ? listItems.length - 1 : index;
                        this.pause = true;
                        break;
                    case 'next':
                        index = this.currentIndex + 1;
                        this.currentIndex = index >= listItems.length ? 0 : index;
                        this.pause = true;
                        break;
                    default:
                        this.currentIndex = direction;
                        this.pause = true;
                        break;
                }

                console.log('pause:', this.pause);
                this.setState({
                    slideIndex: this.currentIndex,
                    slideshow: listItems[this.currentIndex]
                });


            });
        this.state = {slideshow: props.slide, slideIndex: 0};
        this.currentIndex = 0;
        this.pause = false;
    }

    componentDidMount() {
        let that = this;
        this.timeout = setTimeout(function () {
            that.goTo('auto');
        }, 3000);
    }

    componentDidUpdate() {
        const that = this;
        if (this.pause === true) {
            clearInterval(this.timeout);
            this.timePause = setTimeout(function () {
                clearInterval(this.timePause);
            }, 8000);
            this.pause = false;
        }
        this.timeout = setTimeout(function () {
            that.goTo('auto');
        }, 3000);
    }

    componentWillUnmount() {
        clearInterval(this.timeout);
    }

    render() {
        return /*#__PURE__*/ (
            React.createElement("div", {className: "slideshow-simple"}, /*#__PURE__*/
                React.createElement(SlideItem, {
                    title: this.state.slideshow.title,
                    content: this.state.slideshow.content
                }), /*#__PURE__*/

                React.createElement(Indicators, {
                    changeSlide: this.goTo // function
                    ,
                    currentSlide: this.state.slideIndex
                }), /*#__PURE__*/

                React.createElement("div", {className: "wrap-control"}, /*#__PURE__*/
                    React.createElement("button", {
                        className: "btn btn-prev",
                        value: "Prev",
                        onClick: () => this.goTo('prev')
                    }, "Prev"), /*#__PURE__*/
                    React.createElement("button", {
                        className: "btn btn-next",
                        value: "Next",
                        onClick: () => this.goTo('next')
                    }, "Next"))));


    }
}


const element = /*#__PURE__*/ React.createElement(Slides, {slide: listItems[0]});

ReactDOM.render(
    element,
    document.getElementById("root"));