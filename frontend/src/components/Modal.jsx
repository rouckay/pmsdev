import {
  cloneElement,
  createContext,
  useContext,
  useEffect,
  useRef,
  useState,
} from "react";
import { createPortal } from "react-dom";
import { HiXMark } from "react-icons/hi2";

const ModalContext = createContext();

function Modal({ children }) {
  const [openName, setOpenName] = useState("");

  const close = () => setOpenName("");
  const open = setOpenName;

  return (
    <ModalContext.Provider value={{ openName, open, close }}>
      {children}
    </ModalContext.Provider>
  );
}

function Open({ children, opens: opensWindowName }) {
  const { open } = useContext(ModalContext);

  return cloneElement(children, { onClick: () => open(opensWindowName) });
}

const Window = ({ children, name }) => {
  const { openName, close } = useContext(ModalContext);
  const ref = useRef();

  // For detecting a click outside the modal window... this is great as it makes the application more real-world
  useEffect(
    function () {
      function handleClick(e) {
        if (ref.current && !ref.current.contains(e.target)) close();
      }

      document.addEventListener("click", handleClick, true);

      return () => document.removeEventListener("click", handleClick, true);
    },
    [close]
  );

  if (name !== openName) return null;

  return createPortal(
    <div className="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-40 backdrop-blur-sm">
      <div
        ref={ref}
        className="relative bg-white p-10 rounded shadow-lg w-full max-w-4xl max-h-[80vh] overflow-y-auto"
      >
        <button
          onClick={close}
          className="absolute top-3 right-3 text-gray-500 hover:text-gray-700"
        >
          <HiXMark size={24} />
        </button>
        {children}
      </div>
    </div>,
    document.body
  );
};

Modal.Open = Open;
Modal.Window = Window;

export default Modal;

/// OLD MODAL COMPONENT THAT WAS NOT REUSABLE

// const Modal = ({ isOpen, onClose, title, children }) => {
//   if (!isOpen) return null;

//   return (
//     <div className="fixed inset-0 flex items-center justify-center z-50">
//       <div
//         className="absolute inset-0 bg-black opacity-50"
//         onClick={onClose}
//       ></div>

//       <div className="bg-white rounded-lg shadow-lg max-w-md w-full z-50">
//         <div className="flex justify-between items-center p-4 border-b">
//           <h2 className="text-xl font-semibold">{title}</h2>
//           <button
//             onClick={onClose}
//             className="text-gray-500 hover:text-gray-700"
//           >
//             &times;
//           </button>
//         </div>
//         <div className="p-4">{children}</div>
//       </div>
//     </div>
//   );
// };

// export default Modal;
