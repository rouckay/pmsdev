import AddUser from "../features/Users/AddUser";
import UsersTable from "../features/Users/UsersTable";

const Users = () => {
  return (
    <div className="flex flex-col gap-4">
      <AddUser />
      <UsersTable />
    </div>
  );
};

export default Users;
