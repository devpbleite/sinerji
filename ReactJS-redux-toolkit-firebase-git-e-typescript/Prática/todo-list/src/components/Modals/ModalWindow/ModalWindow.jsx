import ModalCloseButton from "../ModalCloseButton";
import "./ModalWindow.scss";

export default function ModalWindow({ children }) {
  return (
    <>
      <div
        className="modal-wrapper"
        aria-modal="true"
        role="dialog"
        tabIndex="-1"
      >
        <div className="inner">
          <ModalCloseButton />
          {children}
        </div>
      </div>
    </>
  );
}
