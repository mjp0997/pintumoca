const debounceTimer = 1000;

const debounce = (callback, timer = debounceTimer) => {
   let timeout;
 
   return (...args) => {
      clearTimeout(timeout);
      timeout = setTimeout(() => callback(...args), timer);
   }
}