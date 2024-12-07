const items = [
  {
      title: "Item 1",
      description: "This is the first item.",
      image: "assets/product1.jpg",
  },
  {
      title: "Item 2",
      description: "This is the second item.",
      image: "assets/product2.jpg",
  },
  {
      title: "Item 3",
      description: "This is the third item.",
      image: "assets/product3.jpg",
  },
  {
      title: "Item 4",
      description: "This is the fourth item.",
      image: "assets/product4.jpg",
  },
  {
      title: "Item 5",
      description: "This is the fifth item.",
      image: "assets/product5.jpg",
  },
  {
      title: "Item 6",
      description: "This is the sixth item.",
      image: "assets/product3.jpg",
  },
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

  const cloneCount = 5; // Adjust to match the number of items visible
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

  currentIndex = 5; // Adjust for 5 items
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
