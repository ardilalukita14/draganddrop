<!DOCTYPE html>
<html lang="en">
<head>
    <title>Drag & Drop</title>
    <!-- http://proger.i-forge.net/The_smallest_transparent_pixel/ -->
    <link rel="icon" href="data:image/gif;base64,R0lGODlhAQABAAAAACwAAAAAAQABAAA=">
    <style>
      .draggable {
          background: #f08976;
          border-radius: 10px;
          border: 1px solid #eb7b6a;
          width: 200px;
          padding: 5px;
          margin: 3px;
          text-align:center;
      }

      .drop-zone {
          width: 300px;
          padding: 10px;
          margin: 10px;
          background: #eee;
          border: 2px solid #31364c;
          min-height: 36px;
      }

      /* Dragged source element style */
      .dragged {
          opacity: .6;
          border-style: dashed;
      }

      /* Drag feedback image style */
      .drag-feedback {
          background: lightskyblue;
          border: 1px solid dodgerblue;
      }

      /* drop zone highlights */
      .active-zone {
          background: #fffad6;
          border: 2px solid #aaa479;
      }

      .over-zone {
          background: #ffc6c6;
          border: 2px solid #931414;
      }

      /* Style for text drag test area */
      .drag-text-test {
          width: 300px;
          margin: 10px;
      }

      .drag-text-test textarea {
          width: 100%;
          padding: 10px;
          height: 36px;
      }

    </style>
    <!-- <link rel="stylesheet" type="text/css" href="drag-drop.css"> -->
    <script src="drag-drop.js" defer></script>
</head>
<body>
<div class="drop-zone">
    <div class="draggable">This can be dragged around.</div>
</div>
<div class="drop-zone"></div>
<div class="drop-zone">
    <div class="draggable">And this is another draggable.</div>
</div>
<div class="drop-zone"></div>
<div class="drag-text-test">
    <label>
        Test what happens when you drag something in this textarea:<br>
        <textarea name="drag-text-test"></textarea>
    </label>
</div>
</body>
<script>
  initDragAndDrop();

  function initDragAndDrop() {
      // Collect all draggable elements and drop zones
      let draggables = document.querySelectorAll(".draggable");
      let dropZones = document.querySelectorAll(".drop-zone");
      initDraggables(draggables);
      initDropZones(dropZones);
  }

  function initDraggables(draggables) {
      for (const draggable of draggables) {
          initDraggable(draggable);
      }
  }

  function initDropZones(dropZones) {
      for (let dropZone of dropZones) {
          initDropZone(dropZone);
      }
  }

  /**
   * Set all event listeners for draggable element
   * https://developer.mozilla.org/en-US/docs/Web/API/DragEvent#Event_types
   */
  function initDraggable(draggable) {
      draggable.addEventListener("dragstart", dragStartHandler);
      draggable.addEventListener("drag", dragHandler);
      draggable.addEventListener("dragend", dragEndHandler);

      // set draggable elements to draggable
      draggable.setAttribute("draggable", "true");
  }

  /**
   * Set all event listeners for drop zone
   * https://developer.mozilla.org/en-US/docs/Web/API/DragEvent#Event_types
   */
  function initDropZone(dropZone) {
      dropZone.addEventListener("dragenter", dropZoneEnterHandler);
      dropZone.addEventListener("dragover", dropZoneOverHandler);
      dropZone.addEventListener("dragleave", dropZoneLeaveHandler);
      dropZone.addEventListener("drop", dropZoneDropHandler);
  }

  /**
   * Start of drag operation, highlight drop zones and mark dragged element
   * The drag feedback image will be generated after this function
   * https://developer.mozilla.org/en-US/docs/Web/API/HTML_Drag_and_Drop_API/Drag_operations#dragfeedback
   */
  function dragStartHandler(e) {
      setDropZonesHighlight();
      this.classList.add('dragged', 'drag-feedback');
      // we use these data during the drag operation to decide
      // if we handle this drag event or not
      e.dataTransfer.setData("type/dragged-box", 'dragged');
      e.dataTransfer.setData("text/plain", this.textContent.trim());
      deferredOriginChanges(this, 'drag-feedback');
  }

  /**
   * While dragging is active we can do something
   */
  function dragHandler() {
      // do something... if you want
  }

  /**
   * Very last step of the drag operation, remove all added highlights and others
   */
  function dragEndHandler() {
      setDropZonesHighlight(false);
      this.classList.remove('dragged');
  }

  /**
   * When entering a drop zone check if it should be allowed to
   * drop an element here and highlight the zone if needed
   */
  function dropZoneEnterHandler(e) {
      // we can only check the data transfer type, not the value for security reasons
      // https://www.w3.org/TR/html51/editing.html#drag-data-store-mode
      if (e.dataTransfer.types.includes('type/dragged-box')) {
          this.classList.add("over-zone");
          // The default action of this event is to set the dropEffect to "none" this way
          // the drag operation would be disallowed here we need to prevent that
          // if we want to allow the dragged element to be drop here
          // https://developer.mozilla.org/en-US/docs/Web/API/Document/dragenter_event
          // https://developer.mozilla.org/en-US/docs/Web/API/DataTransfer/dropEffect
          e.preventDefault();
      }
  }

  /**
   * When moving inside a drop zone we can check if it should be
   * still allowed to drop an element here
   */
  function dropZoneOverHandler(e) {
      if (e.dataTransfer.types.includes('type/dragged-box')) {
          // The default action is similar as above, we need to prevent it
          e.preventDefault();
      }
  }

  /**
   * When we leave a drop zone we check if we should remove the highlight
   */
  function dropZoneLeaveHandler(e) {
      if (e.dataTransfer.types.includes('type/dragged-box') &&
          e.relatedTarget !== null &&
          e.currentTarget !== e.relatedTarget.closest('.drop-zone')) {
          // https://developer.mozilla.org/en-US/docs/Web/API/MouseEvent/relatedTarget
          this.classList.remove("over-zone");
      }
  }

  /**
   * On successful drop event, move the element
   */
  function dropZoneDropHandler(e) {
      // We have checked in the "dragover" handler (dropZoneOverHandler) if it is allowed
      // to drop here, so it should be ok to move the element without further checks
      let draggedElement = document.querySelector('.dragged');
      e.currentTarget.appendChild(draggedElement);

      // We  drop default action (eg. move selected text)
      // default actions detailed here:
      // https://www.w3.org/TR/html51/editing.html#drag-and-drop-processing-model
      e.preventDefault();

  }


  /**
   * Highlight all drop zones or remove highlight
   */
  function setDropZonesHighlight(highlight = true) {
      const dropZones = document.querySelectorAll(".drop-zone");
      for (const dropZone of dropZones) {
          if (highlight) {
              dropZone.classList.add("active-zone");
          } else {
              dropZone.classList.remove("active-zone");
              dropZone.classList.remove("over-zone");
          }
      }
  }

  /**
   * After the drag feedback image has been generated we can remove the class we added
   * for the image generation and/or change the originally dragged element
   * https://javascript.info/settimeout-setinterval#zero-delay-settimeout
   */
  function deferredOriginChanges(origin, dragFeedbackClassName) {
      setTimeout(() => {
          origin.classList.remove(dragFeedbackClassName);
      });
  }


</script>
</html>
