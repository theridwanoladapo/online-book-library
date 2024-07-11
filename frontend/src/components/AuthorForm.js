import React, { useEffect, useState } from 'react';
import { useHistory, useParams } from 'react-router-dom';
import api from '../services/api';

const AuthorForm = () => {
    const { id } = useParams();
    const [name, setName] = useState('');
    const [email, setEmail] = useState('');
    const [biography, setBiography] = useState('');
    const history = useHistory();

    useEffect(() => {
        if (id) {
            api.get(`/authors/${id}`).then(response => {
                const author = response.data;
                setName(author.name);
                setEmail(author.email);
                setBiography(author.biography);
            });
        }
    }, [id]);

    const handleSubmit = async (e) => {
        e.preventDefault();
        const authorData = { name, email, biography };

        try {
            if (id) {
                await api.put(`/authors/${id}`, authorData);
            } else {
                await api.post('/authors', authorData);
            }
            history.push('/');
        } catch (error) {
            console.error('There was an error saving the author!', error);
        }
    };

    return (
        <div>
            <h1>{id ? 'Edit Author' : 'Add Author'}</h1>
            <form onSubmit={handleSubmit}>
                <div>
                    <label>Name:</label>
                    <input
                        type="text"
                        value={name}
                        onChange={(e) => setName(e.target.value)}
                    />
                </div>
                <div>
                    <label>Email:</label>
                    <input
                        type="email"
                        value={email}
                        onChange={(e) => setName(e.target.value)}
                    />
                </div>
                <div>
                    <label>Biography:</label>
                    <textarea
                        value={biography}
                        onChange={(e) => setBiography(e.target.value)}
                    />
                </div>
                <button type="submit">{id ? 'Update' : 'Add'}</button>
            </form>
        </div>
    );
};

export default AuthorForm;
