import { useContext } from "react";
import { ChatContext } from "./Context/ChatContext";

const GroupList = ({ onSelectGroup }) => {
  const { groups } = useContext(ChatContext);

  return (
    <div className="group-list p-4 bg-white shadow-lg rounded-lg">
      <h2 className="text-xl font-bold mb-4">Groups</h2>
      <ul className="space-y-2">
        {groups.map((group) => (
          <li
            key={group.id}
            onClick={() => onSelectGroup(group.id)}
            className="cursor-pointer p-3 bg-gray-100 rounded-lg hover:bg-blue-100 transition-colors"
          >
            {group.name}
          </li>
        ))}
      </ul>
    </div>
  );
};

export default GroupList;
