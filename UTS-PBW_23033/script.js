// script.js
document.addEventListener("DOMContentLoaded", () => {
  let cartCount = 0;
  const cartBtn = document.getElementById("cart-btn");
  const cartCountEl = document.getElementById("cart-count");
  const buyButtons = document.querySelectorAll(".buy-btn");
  const modal = document.getElementById("order-modal");
  const modalMessage = document.getElementById("modal-message");
  const closeModalBtn = document.getElementById("close-modal");
  const contactForm = document.getElementById("contact-form");

  // Tambah ke keranjang
  buyButtons.forEach(button => {
    button.addEventListener("click", () => {
      const item = button.getAttribute("data-item");
      cartCount++;
      cartCountEl.textContent = cartCount;

      Toastify({
        text: `${item} telah ditambahkan ke keranjang!`,
        duration: 3000,
        gravity: "top",
        position: "right",
        backgroundColor: "#4CAF50",
        stopOnFocus: true
      }).showToast();

      modalMessage.textContent = `Terima kasih telah memesan ${item}!`;
      modal.classList.remove("hidden");
      modal.classList.add("show");
    });
  });

  closeModalBtn.addEventListener("click", () => {
    modal.classList.add("hidden");
    modal.classList.remove("show");
  });

  cartBtn.addEventListener("click", () => {
    if (cartCount === 0) {
      Toastify({
        text: "Keranjang kosong!",
        duration: 3000,
        gravity: "top",
        position: "right",
        backgroundColor: "#FF5733",
        stopOnFocus: true
      }).showToast();
    } else {
      modalMessage.textContent = `Anda memiliki ${cartCount} item di keranjang.`;
      modal.classList.remove("hidden");
      modal.classList.add("show");
    }
  });

  contactForm.addEventListener("submit", (e) => {
    e.preventDefault();
    const name = document.getElementById("name").value;
    Toastify({
      text: `Terima kasih, ${name}! Pesan Anda telah dikirim.`,
      duration: 3000,
      gravity: "top",
      position: "right",
      backgroundColor: "#4CAF50",
      stopOnFocus: true
    }).showToast();
    contactForm.reset();
  });
});