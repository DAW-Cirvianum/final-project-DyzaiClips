import { useEffect, useState } from 'react'
import { useParams, useNavigate } from 'react-router-dom'
import api from '../api/axios'

function EditProduct() {
    const { id } = useParams()
    const navigate = useNavigate()

    const [name, setName] = useState('')
    const [type, setType] = useState('')
    const [error, setError] = useState('')

    useEffect(() => {
        api.get(`/products/${id}`)
            .then(res => {
                setName(res.data.name)
                setType(res.data.type)
            })
            .catch(() => {
                setError('Product not found')
            })
    }, [id])

    /**
     * Handle product update (admin only)
     */
    const handleSubmit = async (e) => {
        e.preventDefault()
        setError('')

        try {
            await api.put(`/products/${id}`, {
                name,
                type,
            })

            navigate('/products')
        } catch (err) {
            setError('Error updating product')
        }
    }

    return (
        <div className="page-container">
            <h2>Edit Product</h2>

            {error && <p className="error">{error}</p>}

            <form onSubmit={handleSubmit} className="form">
                <input
                    type="text"
                    placeholder="Product name"
                    value={name}
                    onChange={e => setName(e.target.value)}
                    required
                />

                <select
                    value={type}
                    onChange={e => setType(e.target.value)}
                    required
                >
                    <option value="">Select type</option>
                    <option value="card">Card</option>
                    <option value="pack">Pack</option>
                    <option value="box">Box</option>
                </select>

                <button type="submit" className="product-btn">
                    Save changes
                </button>
            </form>
        </div>
    )
}

export default EditProduct
