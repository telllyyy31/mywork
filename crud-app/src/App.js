import React, { useState } from 'react';
import { v4 as uuidv4 } from 'uuid';
import './App.css';

const App = () => {
  const [items, setItems] = useState([]);
  const [currentItem, setCurrentItem] = useState({ id: null, name: '', surname: '' });

  const handleInputChange = (e) => {
    const { name, value } = e.target;
    setCurrentItem({ ...currentItem, [name]: value });
  };

  const addItem = () => {
    if (currentItem.name && currentItem.surname) {
      setItems([...items, { id: uuidv4(), name: currentItem.name, surname: currentItem.surname }]);
      setCurrentItem({ id: null, name: '', surname: '' });
    }
  };

  const deleteItem = (id) => {
    setItems(items.filter((item) => item.id !== id));
  };

  const editItem = (item) => {
    setCurrentItem(item);
  };

  const updateItem = () => {
    setItems(items.map((item) => (item.id === currentItem.id ? currentItem : item)));
    setCurrentItem({ id: null, name: '', surname: '' });
  };

  return (
    <div className="App">
      <h1>Simple CRUD</h1>
      <input
        type="text"
        name="name"
        value={currentItem.name}
        onChange={handleInputChange}
        placeholder='First Name'
      />
      <input
        type="text"
        name="surname"
        value={currentItem.surname}
        onChange={handleInputChange}
        placeholder='Surname'
      />
      <button onClick={currentItem.id ? updateItem : addItem}>
        {currentItem.id ? 'Update' : 'Add'}
      </button>
      <ul>
        {items.map((item) => (
          <li key={item.id}>
            {item.name} {item.surname}
            <button onClick={() => editItem(item)}>Edit</button>
            <button onClick={() => deleteItem(item.id)}>Delete</button>
          </li>
        ))}
      </ul>
    </div>
  );
};

export default App;