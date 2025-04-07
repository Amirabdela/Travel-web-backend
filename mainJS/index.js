// Ensure the DOM is fully loaded before running the script
document.addEventListener("DOMContentLoaded", () => {
  // Cache references to relevant DOM elements
  const sidebar = document.getElementById("sidebar");
  const closeBtn = document.getElementById("closeBtn");
  const overlay = document.getElementById("overlay");
  const allLink = document.getElementById("logo");

  // Function to toggle the sidebar's visibility
  const toggleSidebar = (isOpen) => {
    // Add or remove the 'active' class to show/hide the sidebar
    sidebar.classList.toggle("active", isOpen);

    // Show or hide the close button
    closeBtn.style.display = isOpen ? "block" : "none";

    // Show or hide the overlay (dim background)
    overlay.style.display = isOpen ? "block" : "none";

    // Add or remove a custom class on the body to indicate sidebar state
    document.body.classList.toggle("sidebar-open", isOpen);

    // Log the current sidebar state for debugging
    console.log("Sidebar state:", isOpen ? "Opened" : "Closed");
  };

  // Open the sidebar when the 'logo' link is clicked
  allLink.addEventListener("click", (event) => {
    event.stopPropagation(); // Prevent event from bubbling to parent elements
    toggleSidebar(true); // Open the sidebar
  });

  // Close the sidebar when the close button is clicked
  closeBtn.addEventListener("click", (event) => {
    event.stopPropagation(); // Prevent event from bubbling to parent elements
    toggleSidebar(false); // Close the sidebar
  });

  // Close the sidebar when clicking on the overlay
  overlay.addEventListener("click", () => toggleSidebar(false));

  // Close the sidebar when clicking outside of the sidebar
  document.addEventListener("click", (event) => {
    if (
      !sidebar.contains(event.target) && // Check if the click is outside the sidebar
      !allLink.contains(event.target) && // Ensure the click is not on the logo link
      !closeBtn.contains(event.target)   // Ensure the click is not on the close button
    ) {
      toggleSidebar(false); // Close the sidebar
    }
  });

  // Prevent clicks inside the sidebar from closing it
  sidebar.addEventListener("click", (event) => {
    event.stopPropagation(); // Prevent event from bubbling to parent elements
  });
});
