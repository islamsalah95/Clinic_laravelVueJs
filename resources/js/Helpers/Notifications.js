class Notification{


    success(message){
        Swal.fire(
            message,
            'You clicked the button!',
            'success'
          )
    } 
  
    error(message){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: message,
          })
    } 
  
     calculateTimePassed(dateString) {
      const date = new Date(dateString); // Create a Date object from the provided date string
      const now = new Date(); // Get the current date and time
    
      // Set the time zone to Egypt
      const egyptTimezoneOffset = 0; // UTC+2 for Egypt
      const egyptOffsetMilliseconds = egyptTimezoneOffset * 60 * 60 * 1000;
      const egyptNow = new Date(now.getTime() + egyptOffsetMilliseconds);
    
      const timeDifference = egyptNow - date; // Calculate the time difference in milliseconds
    
      // Calculate the number of days and hours that have passed
      const daysPassed = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
      const hoursPassed = Math.floor(timeDifference / (1000 * 60 * 60)) % 24;
    
      // Return an object with the days and hours passed
      return {
        daysPassed,
        hoursPassed
      };
    }
    
    deleteObjectById(id, array) {
        const index = array.findIndex(obj => obj.id === id);
        
        if (index !== -1) {
            array.splice(index, 1);
        }
        
        return array;
        }

        
      addObjectToArray(obj, array) {
        array.push(obj);
        return array;
      }
//     deleteProduct(productId){
//   Swal.fire({
//     title: 'Do you want to save the changes?',
//     showDenyButton: true,
//     showCancelButton: true,
//     confirmButtonText: 'delete',
//     denyButtonText: `Don't delete`,
//   }).then((result) => {
//     /* Read more about isConfirmed, isDenied below */
//     if (result.isConfirmed) {
//       Swal.fire('Saved!', '', 'success')
// axios.delete(`http://127.0.0.1:8000/api/deleteProduct/${productId}`).then((response) => {
//               console.log(response.data.data);
//                  return true;
//             }).catch((error) => console.log(error)); 
//     } else if (result.isDenied) {
//       Swal.fire('Changes are not saved', '', 'info')
//     }
//   })
// }
  
  }
  
  export default Notification = new Notification()