const draggables = document.querySelectorAll(".draggable");
const containers = document.querySelectorAll(".js-container");

draggables.forEach((draggable) => {
  draggable.addEventListener("dragstart", () => {
    draggable.classList.add("dragging");
  });

  draggable.addEventListener("dragend", () => {
    draggable.classList.remove("dragging");
  });
});

containers.forEach((container) => {
  container.addEventListener("dragover", (e) => {
    e.preventDefault();
    const afterElement = getDragAfterElement(container, e.clientX, e.clientY);
    const draggable = document.querySelector(".dragging");

    if (afterElement == null) {
      container.appendChild(draggable);
    } else if (container.contains(afterElement)) {
      container.insertBefore(draggable, afterElement);
    }
  });
});

function getDragAfterElement(container, x, y) {
  const draggableElements = [...container.querySelectorAll(".draggable:not(.dragging)")];

  return draggableElements.reduce((closest, child) => {
    const box = child.getBoundingClientRect();
    const offsetVertical = y - (box.top + window.scrollY);
    const offsetHorizontal = x - (box.left + window.scrollX);
    const offsetMagnitude = Math.sqrt(offsetVertical ** 2 + offsetHorizontal ** 2);

    if (offsetMagnitude < closest.offset) {
      return { offset: offsetMagnitude, element: child };
    } else {
      return closest;
    }
  }, { offset: Number.POSITIVE_INFINITY }).element;
}



