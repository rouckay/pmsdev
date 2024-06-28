import { useState, useContext } from "react";
import { ChatContext } from "./Context/ChatContext";

const FileSharing = ({ groupId }) => {
  const { addMessage } = useContext(ChatContext);
  const [file, setFile] = useState(null);

  const handleFileUpload = () => {
    if (file) {
      const message = {
        id: Date.now(),
        groupId,
        senderId: 1, // Assuming current user ID is 1
        content: `File shared: ${file.name}`,
        createdAt: new Date().toISOString(),
      };
      addMessage(message);
      setFile(null);
    }
  };

  return (
    <div className="mb-4">
      <input
        type="file"
        onChange={(e) => setFile(e.target.files[0])}
        className="mb-2 p-2 border rounded w-full"
      />
      <button
        onClick={handleFileUpload}
        className="bg-green-500 text-white p-2 rounded w-full hover:bg-green-600 transition-colors"
      >
        Share File
      </button>
    </div>
  );
};

export default FileSharing;
