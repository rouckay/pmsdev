import { useState, useContext } from "react";
import { ChatContext } from "./Context/ChatContext";

const CreateGroup = () => {
  const [groupName, setGroupName] = useState("");
  const [groupDescription, setGroupDescription] = useState("");
  const { addGroup } = useContext(ChatContext);

  const handleSubmit = (e) => {
    e.preventDefault();
    const newGroup = {
      id: Date.now(),
      name: groupName,
      description: groupDescription,
      createdBy: 1, // Assuming current user ID is 1
    };
    addGroup(newGroup);
    setGroupName("");
    setGroupDescription("");
  };

  return (
    <div className="create-group mb-6">
      <h2 className="text-xl font-bold mb-4">Create Group</h2>
      <form onSubmit={handleSubmit} className="space-y-3">
        <input
          type="text"
          placeholder="Group Name"
          value={groupName}
          onChange={(e) => setGroupName(e.target.value)}
          className="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          required
        />
        <textarea
          placeholder="Group Description"
          value={groupDescription}
          onChange={(e) => setGroupDescription(e.target.value)}
          className="w-full p-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          required
        />
        <button
          type="submit"
          className="w-full bg-blue-500 text-white p-2 rounded-lg hover:bg-blue-600 transition-colors"
        >
          Create Group
        </button>
      </form>
    </div>
  );
};

export default CreateGroup;
