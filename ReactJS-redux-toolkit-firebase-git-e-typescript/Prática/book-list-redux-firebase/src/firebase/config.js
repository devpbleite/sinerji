import { initializeApp } from "firebase/app";
import { getAuth } from "firebase/auth";
import { getFirestore } from "firebase/firestore";

const firebaseConfig = {
  apiKey: "AIzaSyCNUhTy-SSiP6qW3DOf_93Z_q4MXD8fUhA",
  authDomain: "book-list-with-firebase-ca324.firebaseapp.com",
  projectId: "book-list-with-firebase-ca324",
  storageBucket: "book-list-with-firebase-ca324.appspot.com",
  messagingSenderId: "59721670337",
  appId: "1:59721670337:web:59d061051e227647e93e40",
};

const app = initializeApp(firebaseConfig);
export const auth = getAuth(app);
export const db = getFirestore(app);
