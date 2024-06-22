import { useState } from "react";
import Button from "../components/Button";
import UsersTable from "../features/Users/UsersTable";
import UserForm from "../features/Users/CreateUserForm";

const Users = () => {
  const [showUserForm, setShowUserForm] = useState(false);

  const handleClose = () => {
    setShowUserForm(false);
  };

  return (
    <div className="flex flex-col gap-4">
      <div className="pr-2 self-end">
        <Button onClick={() => setShowUserForm((show) => !show)}>
          Add User
        </Button>
      </div>
      <div>{showUserForm && <UserForm onClose={handleClose} />}</div>
      <UsersTable />
    </div>
  );
};

export default Users;
