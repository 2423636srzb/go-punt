// worker.js
self.onmessage = async function (e) {
  const imageUrl = e.data;

  try {
      // Fetch the image as a Blob
      const response = await fetch(imageUrl);
      const blob = await response.blob();

      // Convert the Blob to an ImageBitmap (can be used in Web Worker)
      const imageBitmap = await createImageBitmap(blob);

      // Use OffscreenCanvas to draw the image in the background
      const offscreenCanvas = new OffscreenCanvas(imageBitmap.width, imageBitmap.height);
      const ctx = offscreenCanvas.getContext('2d');
      ctx.drawImage(imageBitmap, 0, 0);

      // Convert the OffscreenCanvas to a Blob
      const imageBlob = await offscreenCanvas.convertToBlob();

      // Convert the Blob to a Base64 data URL using FileReader
      const reader = new FileReader();
      reader.onloadend = function () {
          const dataURL = reader.result; // This will be the Base64 data URL
          self.postMessage(dataURL); // Send the result back to the main thread
      };
      reader.onerror = function (error) {
          console.error('Error converting image to Base64:', error);
          self.postMessage(null);
      };

      reader.readAsDataURL(imageBlob); // Start reading the Blob as a Base64 data URL
  } catch (error) {
      console.error("Error processing image:", error);
      self.postMessage(null); // Notify the main thread if there was an error
  }
};
