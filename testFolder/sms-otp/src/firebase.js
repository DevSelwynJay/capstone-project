import firebase from "firebase/compat/app";
import 'firebase/compat/auth'
const firebaseConfig = {
    apiKey: "AIzaSyCp0izZKXrwRCfmfGkLgogG-He_tX-7L00",
    authDomain: "capstoneproject3m-his.firebaseapp.com",
    projectId: "capstoneproject3m-his",
    storageBucket: "capstoneproject3m-his.appspot.com",
    messagingSenderId: "373815557222",
    appId: "1:373815557222:web:44c490f0efc8775211c1a7"
};

// Initialize Firebase
//const app = initializeApp(firebaseConfig);
firebase.initializeApp(firebaseConfig)

export default firebase