import Button from "../../components/Button";
import Modal from "../../components/Modal";
import CreateUserForm from "../Users/CreateUserForm";

const AddUser = () => {
  return (
    <Modal>
      <Modal.Open opens="user-form">
        <Button onClick={close}>Add User</Button>
      </Modal.Open>
      <Modal.Window name="user-form">
        <CreateUserForm />
      </Modal.Window>
    </Modal>
  );
};

export default AddUser;
