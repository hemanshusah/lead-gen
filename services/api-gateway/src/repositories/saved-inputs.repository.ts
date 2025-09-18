import {inject} from '@loopback/core';
import {DefaultCrudRepository} from '@loopback/repository';
import {PostgresDataSource} from '../datasources';
import {SavedInputs, SavedInputsRelations} from '../models';

export class SavedInputsRepository extends DefaultCrudRepository<
  SavedInputs,
  typeof SavedInputs.prototype.id,
  SavedInputsRelations
> {
  constructor(
    @inject('datasources.Postgres') dataSource: PostgresDataSource,
  ) {
    super(SavedInputs, dataSource);
  }
}
