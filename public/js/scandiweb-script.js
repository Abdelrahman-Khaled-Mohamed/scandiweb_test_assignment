
const TYPE_SWITCHER = document.getElementById('productType');

const BOOK_CONTAINER = document.getElementById('book-input-div');
const WEIGHT = document.getElementById("weight")

const DVD_CONTAINER = document.getElementById('dvd-input-div');
const SIZE = document.getElementById("size")

const FURNITURE_CONTAINER = document.getElementById('furniture-input-div');
const HEIGHT = document.getElementById("height")
const WIDTH = document.getElementById("width")
const LENGTH = document.getElementById("length")

document.addEventListener("readystatechange", (event) => {
    TYPE_SWITCHER.addEventListener("change", (event) => {
        switchTypes();
    });

    switchTypes();
});

const switchTypes = () => {
    if (TYPE_SWITCHER.value === 'book') {
        BOOK_CONTAINER.style.display = 'block';
        WEIGHT.setAttribute("required", "");

        DVD_CONTAINER.style.display = 'none';
        SIZE.removeAttribute("required");

        FURNITURE_CONTAINER.style.display = 'none';
        HEIGHT.removeAttribute("required");
        WIDTH.removeAttribute("required");
        LENGTH.removeAttribute("required");
    } else if (TYPE_SWITCHER.value === 'dvd') {
        BOOK_CONTAINER.style.display = 'none';
        WEIGHT.removeAttribute("required");

        DVD_CONTAINER.style.display = 'block';
        SIZE.setAttribute("required", "");

        FURNITURE_CONTAINER.style.display = 'none';
        HEIGHT.removeAttribute("required");
        WIDTH.removeAttribute("required");
        LENGTH.removeAttribute("required");
    }else if (TYPE_SWITCHER.value === 'furniture') {
        BOOK_CONTAINER.style.display = 'none';
        WEIGHT.removeAttribute("required");

        DVD_CONTAINER.style.display = 'none';
        SIZE.removeAttribute("required");

        FURNITURE_CONTAINER.style.display = 'block';
        HEIGHT.setAttribute("required", "");
        WIDTH.setAttribute("required", "");
        LENGTH.setAttribute("required", "");
    }
};