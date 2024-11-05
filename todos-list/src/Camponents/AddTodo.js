import React, { useState } from 'react';

export default function TodoForm({addTodo}) {
  const [title, setTitle] = useState('');
  const [desc, setDesc] = useState('');
  let submit = (e) => {
    e.preventDefault();
    if(!title || !desc){
      window.alert("title or desc can't be blank");
    }else{
      addTodo(title,desc);
      setTitle('');
      setDesc('');
    }
  }
  return (
    <div className="container">
      <h2 className="text-center text-warning my-3">Add a Todo</h2>
      <form onSubmit={submit}>
        <div className="form-floating mb-3">
          <input type="text" value={title} onChange={(e) => setTitle(e.target.value)} className="form-control" id="floatingInput"/>
          <label htmlFor="floatingInput">Title</label>
        </div>
        <div className="form-floating">
          <input type="text" value={desc} onChange={(e) => setDesc(e.target.value)} className="form-control" id="floatingDesc" />
          <label htmlFor="floatingDesc">Desc</label>
        </div>
        <button className="btn btn-primary my-2">Add Todo</button>
      </form>
    </div>
  );
}
