<?php

namespace Pluma\Support\Repository;

interface RepositoryInterface
{
    /**
     * Retrieve all instances of model.
     */
    public function all();

    /**
     * Create model resource.
     *
     * @param array $data
     */
    public function create(array $data);

    /**
     * Update model resource.
     *
     * @param array  $data
     * @param int $id
     */
    public function update(array $data, $id);

    /**
     * Retrieve model resource details.
     *
     * @param int $id
     */
    public function find($id);

    /**
     * Permanently delete model resource.
     *
     * @param int $id
     */
    public function delete($id);

    /**
     * Soft delete model resource.
     *
     * @param int $id
     */
    public function destroy($id);

    /**
     * Restore model resource.
     *
     * @param int $id
     */
    public function restore($id);
}
