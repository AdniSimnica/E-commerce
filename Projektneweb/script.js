const items = [
  {
      title: "Initio Side Effect 90ml",
      description: "229.90 €",
      image: "assets/product1.jpg",
  },
  {
      title: "Xerjoff Erba Pura, 100 ml",
      description: "169.99 €",
      image: "assets/product2.jpg",
  },
  {
      title: "JPG Ultra Male 125 ml",
      description: "115.50 €",
      image: "assets/product3.jpg",
  },
  {
      title: "Tom Ford Oud Wood, 50 ml",
      description: "149.99 €",
      image: "assets/product4.jpg",
  },
  {
      title: "JPG Le beau 90ml",
      description: "119.90 €",
      image: "assets/product5.jpg",
  },
  {
      title: "Angels Share by Kilian",
      description: "249.90 €",
      image: "assets/product6.jpg",
  },
  {
    title: "Tom Ford Mandarino di Amalfi",
    description: "145.50 €",
    image: "assets/product7.jpg",
},
{
    title: "Tom Ford Tobacco Vanille",
    description: "149.99 €",
    image: "assets/product8.jpg",
},
{
    title: "Guerlain L'Homme",
    description: "125.90 €",
    image: "assets/product9.jpg",
},
{
    title: "Valentino Born in Roma",
    description: "149.99 €",
    image: "assets/product10.jpg",
},
{
    title: "Chanel Coco Mademoiselle, 100ml",
    description: "199.90 €",
    image: "assets/product11.jpg",
},
{
    title: "Yves Saint Laurent Libre, 90ml",
    description: "159.90 €",
    image: "assets/product12.jpg",
},
{
    title: "Dolce & Gabbana Light Blue, 100ml",
    description: "129.90 €",
    image: "assets/product13.jpg",
},
{
    title: "Lancome La Vie Est Belle, 75ml",
    description: "149.90 €",
    image: "assets/product14.jpg",
},
{
    title: "Gucci Bloom, 100ml",
    description: "139.90 €",
    image: "assets/product15.jpg",
},
{
    title: "Marc Jacobs Daisy, 100ml",
    description: "119.90 €",
    image: "assets/product16.jpg",
},
{
    title: "Dior J'adore, 100ml",
    description: "179.90 €",
    image: "assets/product17.jpg",
},
{
    title: "Versace Bright Crystal, 90ml",
    description: "119.99 €",
    image: "assets/product18.jpg",
},
{
    title: "Armani Si, 100ml",
    description: "149.99 €",
    image: "assets/product19.jpg",
},
{
    title: "Carolina Herrera Good Girl, 80ml",
    description: "159.99 €",
    image: "assets/product20.jpg",
}

];

const sliderContainer = document.querySelector("#slider-container");
let currentIndex = 0;
let slideWidth = 0;

function createSliderItems() {
  items.forEach((item) => {
      const slide = document.createElement("div");
      slide.classList.add("slider-item");

      const img = document.createElement("img");
      img.src = item.image;
      img.alt = item.title;

      const title = document.createElement("h2");
      title.textContent = item.title;

      const desc = document.createElement("p");
      desc.textContent = item.description;

      slide.appendChild(img);
      slide.appendChild(title);
      slide.appendChild(desc);
      sliderContainer.appendChild(slide);
  });
}

function cloneSlides() {
  const allSlides = Array.from(sliderContainer.children);

  const cloneCount = 1// Adjust to match the number of items visible
  const firstGroup = allSlides.slice(0, cloneCount);
  const lastGroup = allSlides.slice(-cloneCount);

  firstGroup.forEach((slide) => {
      const clone = slide.cloneNode(true);
      sliderContainer.appendChild(clone);
  });

  lastGroup.forEach((slide) => {
      const clone = slide.cloneNode(true);
      sliderContainer.insertBefore(clone, sliderContainer.firstChild);
  });
}

function initializeSlider() {
  createSliderItems();
  cloneSlides();

  slideWidth = sliderContainer.firstElementChild.offsetWidth;

  currentIndex = 1; // Adjust for 5 items
  sliderContainer.style.transform = `translateX(-${
      currentIndex * slideWidth
  }px)`;

  setInterval(moveToNextSlide, 3000);

  sliderContainer.addEventListener("transitionend", handleTransitionEnd);
}

function moveToNextSlide() {
  currentIndex++;
  sliderContainer.style.transition = "transform 0.5s ease";
  sliderContainer.style.transform = `translateX(-${
      currentIndex * slideWidth
  }px)`;
}

function handleTransitionEnd() {
  const totalSlides = sliderContainer.children.length;
  const cloneCount = 5; // Adjust to match the number of items visible

  if (currentIndex === totalSlides - cloneCount) {
      sliderContainer.style.transition = "none";
      currentIndex = cloneCount;
      sliderContainer.style.transform = `translateX(-${
          currentIndex * slideWidth
      }px)`;
  }
}

initializeSlider();
