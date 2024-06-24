import FullPageLoader from "../components/FullPageLoader.jsx";
import { useState } from "react";
import { auth } from "../firebase/config.js";
import {
  createUserWithEmailAndPassword,
  sendPasswordResetEmail,
  signInWithEmailAndPassword,
  onAuthStateChanged,
} from "firebase/auth";
import { useDispatch } from "react-redux";
import { setUser } from "../store/usersSlice.js";

export default function LoginPage() {
  const dispatch = useDispatch();
  const [isLoading, setIsLoading] = useState(true);
  const [loginType, setLoginType] = useState("login");
  const [useCredentials, setUseCredentials] = useState({});
  const [error, setError] = useState("");

  onAuthStateChanged(auth, (user) => {
    if (user) {
      dispatch(
        setUser({
          id: user.uid,
          email: user.email,
        })
      );
    } else {
      dispatch(setUser(null));
    }
    if (isLoading) {
      setIsLoading(false);
    }
  });

  function handleCredentials(e) {
    setUseCredentials({ ...useCredentials, [e.target.name]: e.target.value });
  }

  function handleSignup(e) {
    e.preventDefault();
    setError("");

    createUserWithEmailAndPassword(
      auth,
      useCredentials.email,
      useCredentials.password
    ).catch((error) => {
      setError(error.message);
    });
  }

  function handleLogin(e) {
    e.preventDefault();
    setError("");

    signInWithEmailAndPassword(
      auth,
      useCredentials.email,
      useCredentials.password
    ).catch((error) => {
      setError(error.message);
    });
  }

  function handlePassReset(e) {
    const email = prompt("Please enter your email to reset your password");
    sendPasswordResetEmail(auth, email);
    alert("Password reset email sent! Please check your inbox.");
  }

  return (
    <>
      {isLoading && <FullPageLoader></FullPageLoader>}

      <div className="container login-page">
        <section>
          <h1>Welcome to the Book App</h1>
          <p>Login or create an account to continue</p>
          <div className="login-type">
            <button
              className={`btn ${loginType == "login" ? "selected" : ""}`}
              onClick={() => setLoginType("login")}
            >
              Login
            </button>
            <button
              className={`btn ${loginType == "signup" ? "selected" : ""}`}
              onClick={() => setLoginType("signup")}
            >
              Signup
            </button>
          </div>
          <form className="add-form login">
            <div className="form-control">
              <label>Email *</label>
              <input
                onChange={(e) => handleCredentials(e)}
                type="text"
                name="email"
                placeholder="Enter your email"
              />
            </div>
            <div className="form-control">
              <label>Password *</label>
              <input
                onChange={(e) => handleCredentials(e)}
                type="password"
                name="password"
                placeholder="Enter your password"
              />
            </div>
            {loginType == "login" ? (
              <button
                onClick={(e) => handleLogin(e)}
                className="active btn btn-block"
              >
                Login
              </button>
            ) : (
              <button
                onClick={(e) => handleSignup(e)}
                className="active btn btn-block"
              >
                Sign Up
              </button>
            )}

            {error && <div className="error">{error}</div>}

            <p onClick={handlePassReset} className="forgot-password">
              Forgot Password?
            </p>
          </form>
        </section>
      </div>
    </>
  );
}
