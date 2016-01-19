/**
 * A JavaScript code snippet to remove duplicates from array.
 * The array will have unique items after the iteration.
 **/
var arr = [1, 3, 2, 4, 3, 5, 2, 9, 1]; 

arr = arr.reverse().filter(function (e, i, arr) {
    return arr.indexOf(e, i+1) === -1;
}).reverse();

console.log(arr);
// Output: [1, 3, 2, 4, 5, 9]
