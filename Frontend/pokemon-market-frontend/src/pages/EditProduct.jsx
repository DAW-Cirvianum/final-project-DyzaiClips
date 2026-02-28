import { useEffect, useState } from 'react'
import { useParams, useNavigate } from 'react-router-dom'
import api from '../api/axios'

function EditProduct() {
    const { id } = useParams()
    const navigate = useNavigate()

    // Formulari producte
    const [name, setName] = useState('')
    const [type, setType] = useState('')
    const [error, setError] = useState({})
    const [loading, setLoading] = useState(true)
    const [submitting, setSubmitting] = useState(false)

    // Fetch product inicial
    useEffect(() => {
        setLoading(true)
        api.get(`/products/${id}`)
            .then(res => {
                setName(res.data.name)
                setType(res.data.type)
                setLoading(false)
            })
            .catch(err => {
                console.error(err)
                if (err.response && err.response.status === 404) {
                    setError({ general: 'Product not found' })
                } else {
                    setError({ general: 'Error fetching product data' })
                }
                setLoading(false)
            })
    }, [id])

    const handleSubmit = async (e) => {
        e.preventDefault()
        setError({})
        setSubmitting(true)

        // VALIDACIÓ CLIENT
        const clientErrors = {}
        if (!name.trim()) clientErrors.name = 'Product name is required'
        if (!type) clientErrors.type = 'Please select a product type'

        if (Object.keys(clientErrors).length) {
            setError(clientErrors)
            setSubmitting(false)
            return
        }

        try {
            await api.put(`/products/${id}`, { name, type })
            navigate('/products')
        } catch (err) {
            console.error(err)
            if (err.response) {
                switch (err.response.status) {
                    case 422:
                        setError(err.response.data.errors || { general: 'Validation failed' })
                        break
                    case 500:
                        setError({ general: 'Server error' })
                        break
                    default:
                        setError({ general: 'Unexpected error' })
                }
            } else {
                setError({ general: 'Cannot connect to server' })
            }
        } finally {
            setSubmitting(false)
        }
    }

    if (loading) return <p>Loading product data...</p>

    return (
        <div className="page-container">
            <h2>Edit Product</h2>

            {error.general && <p className="error">{error.general}</p>}

            <form onSubmit={handleSubmit} className="form">
                {/* Name */}
                <div>
                    <input
                        type="text"
                        placeholder="Product name"
                        value={name}
                        onChange={e => setName(e.target.value)}
                        required
                    />
                    {error.name && <p className="error">{error.name}</p>}
                </div>

                {/* Type */}
                <div>
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
                    {error.type && <p className="error">{error.type}</p>}
                </div>

                <button type="submit" disabled={submitting}>
                    {submitting ? 'Saving...' : 'Save changes'}
                </button>
            </form>
        </div>
    )
}

export default EditProduct