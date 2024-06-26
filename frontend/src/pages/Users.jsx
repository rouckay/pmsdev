import Button from "../components/Button";
import UsersTable from "../features/Users/UsersTable";
import UserForm from "../features/Users/CreateUserForm";
import Modal from "../components/Modal";

const Users = () => {
  return (
    <div className="flex flex-col gap-4">
      <Modal>
        <Modal.Open opens="user-form">
          <Button onClick={close}>Add User</Button>
        </Modal.Open>
        <Modal.Window name="user-form">
          <UserForm />
        </Modal.Window>
      </Modal>
      <UsersTable />
    </div>
  );
};

export default Users;
