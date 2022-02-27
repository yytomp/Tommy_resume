/**
 * ? Because we are using local storage to store this value, This section of code,
 * ? need to be kept out of the "load" event, If we left it in there,
 * ? there would be a slight delay/lag between changing the color to the local storage value.
 */
let currentHUE = localStorage.getItem('dw-micronix-hue');
if (localStorage.getItem('dw-micronix-hue')) {
    document.documentElement.classList.add(currentHUE)
}

window.addEventListener("load", function() {

    /**
     * ? Toggle Button
     */
    const toggleHUE = document.querySelector('#dw-micronix-toggle');
    let imgArr = document.querySelectorAll('a img');

    [...imgArr].forEach((img) => {
            img.parentNode.style.filter = "hue-rotate(0deg)";
        })
        /**
         * ? Array of available HUE
         */
    const hueClasses = ["blue-hue", "purple-hue", "pink-hue", "orange-hue", "green-hue"];
    /**
     * ? If a HUE class exists in local storage, 
     * ? we need to find the current HUE been used in the array and update in the incrementation value
     */
    let i = (hueClasses.indexOf(currentHUE) && hueClasses.indexOf(currentHUE) !== -1) ? hueClasses.indexOf(currentHUE) : 0

    toggleHUE.addEventListener("click", () => {

        i++;

        /**
         * ? If the increment value goes above the total array length, remove all the HUE classes.
         */
        if (i > hueClasses.length - 1) {
            document.documentElement.classList.remove('blue-hue', 'purple-hue', 'pink-hue', 'orange-hue', 'green-hue')
            i = -1;
        }

        if (i < hueClasses.length) {

            /**
             * ? Upon selecing a new HUE, remove the old one.
             */
            document.documentElement.classList.remove(hueClasses[i - 1])
                /**
                 * ? Add the new HUE class to the HTML element.
                 */
            document.documentElement.classList.add(hueClasses[i])
                /**
                 * ? I have not added the default color of the theme to the HUE classes, simply because there is no need,
                 * ? This been said, when the default color loops back around, it inserts a value of "undefined" into the HTML element,
                 * ? So check for this is done here, if the value is "undefined", we just simple remove it from the element.
                 */
            if (undefined === hueClasses[i]) {
                localStorage.removeItem('dw-micronix-hue')
                document.documentElement.classList.remove('undefined')
            } else {
                /**
                 * ? Add the HUE value to the browsers local storage.
                 */
                localStorage.setItem('dw-micronix-hue', hueClasses[i])
            }

        }
    });
});