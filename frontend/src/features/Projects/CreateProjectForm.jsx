import { useForm } from "react-hook-form";
import Button from "../../components/Button";

const CreateProjectForm = () => {
  const { register, handleSubmit } = useForm();
  const onSubmit = (data) => console.log(data);

  return (
    <form onSubmit={handleSubmit(onSubmit)} className="p-8 bg-red-300">
      <label htmlFor="name">Name</label>
      <input id="name" className="" {...register("name")} />
      <label htmlFor="start_date">Start_Date</label>
      <input id="start_date" type="date" {...register("start_date")} />
      <label htmlFor="end_date">End_Date</label>
      <input id="end_date" type="date" {...register("end_date")} />
      <label htmlFor="department">Department</label>
      <select id="department" {...register("department")}>
        <option value="Web">Web Developement</option>
        <option value="AI">Artificial Intelligence</option>
        <option value="IT">IT</option>
      </select>
      <Button type="submit">Submit</Button>
    </form>
  );
};

export default CreateProjectForm;
